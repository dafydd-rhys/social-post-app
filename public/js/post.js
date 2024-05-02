function visit(commentableType, commentableId) {
    if (commentableType.toLowerCase().includes('user')) {
        window.location.href = '/user/' + commentableId;
    } else {
        window.location.href = '/post/' + commentableId;
    }
}

function sendNotification(email) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    $.ajax({
        url: '/send-email',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken, 
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


function comment(userId, id, post, posterEmail) {
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

    $.ajax({
        //web route
        url: '/save',
        type: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify({
            commentable_id: id,
            commentable_type: post,
            user_id: userId,
            content: commentContent
        }),
        success: function(response) {
            console.log(response);
            sendNotification(posterEmail);
        },
        error: function(xhr, status, error) {
            console.error('Failed to post comment:', error);
        }
    });
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

        window.location.reload();
        console.log('Comment deleted successfully.');
    } catch (error) {
        console.error('Error deleting Comment:', error);
    }
}
