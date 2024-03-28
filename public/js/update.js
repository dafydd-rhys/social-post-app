function updatePost(id) {
    var newTitle = document.querySelector('.post-title-box').value;
    var newContent = document.querySelector('.post-comment-box').value;

    // Validate title and content length
    if (newTitle.length === 0 || newTitle.length > 100 || newContent.length === 0 || newContent.length > 300) {
        alert('Title must be between 1 and 100 characters, and content must be between 1 and 300 characters.');
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
    if (newContent.length === 0 || newContent.length > 300) {
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
