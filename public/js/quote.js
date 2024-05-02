$(document).ready(function() {
    fetchRandomQuote();

    function fetchRandomQuote() {
        const apiUrl = 'https://api.quotable.io/random';

        $.getJSON(apiUrl, function(data) {
            const quote = data.content;
            const author = data.author;

            $('#quote').text(`"${quote}" - ${author}`);
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('quoteOverlay').style.display = 'flex';
});

function closePopup() {
    document.getElementById('quoteOverlay').style.display = 'none';
}