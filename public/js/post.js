function save() {
    
}

function report() {
    
}

function sendEmail(email) {
    // Retrieve CSRF token from meta tag
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    $.ajax({
        url: '/send-email',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken, // Include CSRF token in headers
        },
        data: {
            recipientEmail: email,
            title: 'Someone Interacted with your post',
            content: 'Someone just interacted with your post, login to see who!'
        },
        success: function(response) {
            console.log('Email sent successfully:', response.message);
        },
        error: function(xhr, status, error) {
            console.error('Error sending email:', error);
        }
    });
}


async function comment(userId, postId, posterEmail) {
    try {
        if (!userId || userId === 'null') {
            alert('Please log in to comment.');
            window.location.href = '/login';

            return;
        }

        var commentContent = $('.comment-box').val();
        if (commentContent.length === 0 || commentContent.length >= 500) {
            alert('Comment must be between 1 and 500 characters.');
            return;
        }

        var response = await fetch('/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                user_id: userId,
                website_posts_id: postId,
                content: commentContent
            })
        });

        if (response.ok) {
            console.log('Comment posted successfully.');
            sendEmail(posterEmail);
            location.reload();
        } else {
            console.error('Failed to post comment.');
        }
    } catch (error) {
        console.error('Error posting comment:', error);
    }
}


async function deletePost(postId) {
    try {
        fetch(`/post/${postId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        console.log('Post deleted successfully.');
    } catch (error) {
        console.error('Error deleting post:', error);
    }
}

function deleteComment(commentId) {
    try {
        fetch(`/comment/${commentId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        console.log('Comment deleted successfully.');
    } catch (error) {
        console.error('Error deleting Comment:', error);
    }
}
