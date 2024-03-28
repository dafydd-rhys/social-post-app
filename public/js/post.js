function save() {
    
}

function report() {
    
}

function editPost(postId) {
    console.log("ID: " + postId);
}

function editComment(commentId) {
    console.log("ID: " + commentId);
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
