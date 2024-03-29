document.addEventListener('DOMContentLoaded', function() {
    const currentBlade = document.body.id;

    function updateCharacterCount(textareaSelector, infoSelector, maxCharacters) {
        const textarea = document.querySelector(textareaSelector);
        const infoParagraph = document.querySelector(infoSelector);

        textarea.addEventListener('input', function() {
            const currentCharacters = this.value.length;
            infoParagraph.textContent = currentCharacters + " / " + maxCharacters;
        });
    }

    // Apply character count functionality based on the open blade file
    if (currentBlade === 'edit-comments-blade') {
        updateCharacterCount('.comment-box', '.info', 500);
    } else if (currentBlade === 'edit-posts-blade') {
        updateCharacterCount('.post-title-box', '.title-info', 300);
        updateCharacterCount('.post-comment-box', '.description-info', 1000);
    }
});

function updatePost(id) {
    var newTitle = document.querySelector('.post-title-box').value;
    var newContent = document.querySelector('.post-comment-box').value;

    // Validate title and content length
    if (newTitle.length === 0 || newTitle.length > 300 || newContent.length === 0 || newContent.length > 1000) {
        alert('Title must be between 1 and 100 characters, and content must be between 1 and 1000 characters.');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/update-post/' + id, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert('Post updated successfully!');
                window.location.href = '/post/' + id;
            } else {
                alert('Failed to update post. Please try again later.');
            }
        }
    };
    xhr.send(JSON.stringify({ title: newTitle, content: newContent }));
}

function updateComment(id, post) {
    var newContent = document.querySelector('.comment-box').value;

    // Validate new content length
    if (newContent.length === 0 || newContent.length > 500) {
        alert('Comment must be between 1 and 300 characters.');
        return;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/update-comment/' + id, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert('Comment updated successfully!');
                window.location.href = '/post/' + post;
            } else {
                alert('Failed to update comment. Please try again later.');
            }
        }
    };
    xhr.send(JSON.stringify({ content: newContent }));
}

function createPost() {
    var title = document.querySelector('.post-title-box').value;
    var content = document.querySelector('.post-comment-box').value;

    if (title.trim().length === 0 || title.trim().length > 300) {
        alert('Title must be between 1 and 300 characters.');
        return;
    }

    if (content.trim().length === 0 || content.trim().length > 1000) {
        alert('Content must be between 1 and 1000 characters.');
        return;
    }

    fetch('/create-post', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ title: title, content: content })
    })
    .then(response => {
        if (response.ok) {
            alert('Post created successfully!');
            window.location.href = '/';
        } else {
            alert('Failed to create post. Please try again later.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again later.');
    });
}

