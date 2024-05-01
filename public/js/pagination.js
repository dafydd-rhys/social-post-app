function updatePageCount(currentPage) {
    document.getElementById('currentPage').value = currentPage;
    document.getElementById('pageCount').textContent = currentPage;
}

function prevPage() {
    var currentPage = parseInt(document.getElementById('currentPage').value);
    
    if (currentPage > 1) {
        currentPage--;
        updatePageCount(currentPage);

        $.ajax({
            url: '/prevPage',
            type: 'GET',
            data: { page: currentPage },
            success: function(data) {
                $('.post-container').empty();
                $('.post-container').append(data);

                var currentPage = document.getElementById('currentPage').value;
                console.log(currentPage);
            },
            error: function(xhr, _status, _error) {
                console.error(xhr.responseText);
            }
        });
    }
}

function nextPage() {
    var currentPage = parseInt(document.getElementById('currentPage').value);
    currentPage++;

    $.ajax({
        url: '/nextPage', 
        type: 'GET',
        data: { page: currentPage }, 
        success: function(data) {
            $('.post-container').empty();
            $('.post-container').append(data);

            var tempContainer = document.createElement('div');
            tempContainer.innerHTML = data;
            var currentPageElement = tempContainer.querySelector('#currentPage');
            var currentPageValue = currentPageElement ? currentPageElement.value : null;

            if (currentPageValue != null) {
                updatePageCount(currentPageValue);
            } else {
                updatePageCount(currentPage);
            } 
        },
        error: function(xhr, _status, _error) {
            console.error(xhr.responseText);
        }
    });
}

