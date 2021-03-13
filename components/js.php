<script>
    function increment(event) {
        const id = event.target.id.replace('i-', '');
        const target = document.querySelector(`#${id}`);

        target.value = parseInt(target.value) + 1;

        target.dispatchEvent(new Event('change'));
    }

    function decrement(event) {
        const id = event.target.id.replace('d-', '');
        const target = document.querySelector(`#${id}`);

        target.value = Math.max(parseInt(target.value) - 1, 1);

        target.dispatchEvent(new Event('change'));
    }

    function unhide_js() {
        document.querySelectorAll(".nojs").forEach(noJS => noJS.classList.remove('nojs'));
    }

    document.addEventListener('DOMContentLoaded', (event) => unhide_js());
</script>