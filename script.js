let selectedRating = 0;

document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', () => {
        selectedRating = parseInt(star.getAttribute('data-value'));
        document.querySelectorAll('.star').forEach(s => s.classList.remove('selected'));
        for (let i = 0; i < selectedRating; i++) {
            document.querySelectorAll('.star')[i].classList.add('selected');
        }
    });
});

document.getElementById('submitBtn').addEventListener('click', () => {
    const comment = document.getElementById('comment').value;

    if (selectedRating > 0) {
        fetch('submit.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `rating=${selectedRating}&comment=${comment}`
        }).then(() => {
            alert('Terima kasih atas penilaian Anda!');
            location.reload();
        });
    } else {
        alert('Silakan pilih rating terlebih dahulu!');
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const ratings = document.querySelectorAll('.result ul li .star-bar');

    ratings.forEach((rating, index) => {
        console.log(`Processing rating ${index + 1}:`, rating);

        const percentageElement = rating.querySelector('span:last-child');
        if (!percentageElement) {
            console.error(`Percentage element not found for rating ${index + 1}:`, rating);
            return; // Skip this iteration
        }

        const percentage = parseFloat(percentageElement.textContent.replace('%', ''));

        let colorClass = '';
        if (percentage >= 80) {
            colorClass = 'green';
        } else if (percentage >= 60) {
            colorClass = 'yellow';
        } else if (percentage >= 40) {
            colorClass = 'orange';
        } else {
            colorClass = 'red';
        }

        const filledStar = rating.querySelector('.filled-star');
        if (!filledStar) {
            console.error(`Filled star element not found for rating ${index + 1}:`, rating);
            return; // Skip this iteration
        }

        console.log(`Adding class "${colorClass}" to rating ${index + 1}`);
        filledStar.classList.add(colorClass);
    });
});




