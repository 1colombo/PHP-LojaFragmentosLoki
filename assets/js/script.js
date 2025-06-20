    const TOTAL = 70;
    const container = document.querySelector('.chuva');

    for (let i = 0; i < TOTAL; i++) {
        const sq = document.createElement('span');

        const size = Math.floor(Math.random() * 40) + 10;
        sq.style.width = size + 'px';
        sq.style.height = size + 'px';
        sq.style.left = Math.random() * 100 + 'vw';
        sq.style.animationDuration = (3 + Math.random() * 5) + 's';
        sq.style.animationDelay = (-Math.random() * 5) + 's';

        container.appendChild(sq);
    }