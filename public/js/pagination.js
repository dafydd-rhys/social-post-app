function updatePageCount() {
    var currentPage = document.getElementById('currentPage').value;
    document.getElementById('pageCount').textContent = currentPage;
}

function prevPage() {
    var currentPage = document.getElementById('currentPage');
    
    if (currentPage.value > 1) {
        currentPage.value--;
        updatePageCount();
        console.log(currentPage);

        // Make an AJAX request to fetch the previous set of posts
        $.ajax({
            url: '/prevPage',
            type: 'GET',
            data: { page: currentPage.value },
            success: function(data) {
                $('.post-container').empty();
                $('.post-container').append(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}
function nextPage() {
    var currentPage = document.getElementById('currentPage');
    currentPage.value++;
    updatePageCount();
    console.log(currentPage);

    $.ajax({
        url: '/nextPage', 
        type: 'GET',
        data: { page: currentPage.value }, 
        success: function(data) {
            $('.post-container').empty();
            $('.post-container').append(data);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
