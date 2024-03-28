function updateComment(id, post) {
    var newContent = document.querySelector('.comment-box').value;
    console.log(id + "ddd" + post)

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
