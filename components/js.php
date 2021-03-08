<script>
    function increment(id) {
        document.querySelector(`#${id}`).value = parseInt(document.querySelector(`#${id}`).value) + 1;
    }

    function decrement(id) {
        document.querySelector(`#${id}`).value = Math.max(parseInt(document.querySelector(`#${id}`).value) - 1, 1);
    }

    function unhide_js() {
        document.querySelectorAll(".nojs").forEach(noJS => noJS.classList.remove('nojs'));
    }

    document.addEventListener('DOMContentLoaded', (event) => unhide_js());
</script>