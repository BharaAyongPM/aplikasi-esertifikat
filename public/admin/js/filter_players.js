document.addEventListener('DOMContentLoaded', function() {
    const filterClubDropdown = document.getElementById('filter_club');
    const playersRows = document.querySelectorAll('tbody tr');

    filterClubDropdown.addEventListener('change', function() {
        const selectedClubId = filterClubDropdown.value;

        playersRows.forEach(row => {
            const clubId = row.getAttribute('data-club');

            if (selectedClubId === '' || clubId === selectedClubId) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
