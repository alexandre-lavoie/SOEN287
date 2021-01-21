<script>
    function increment(id) {
        document.querySelector(`#${id}`).innerText = parseInt(document.querySelector(`#${id}`).innerText) + 1;
    }

    function decrement(id) {
        document.querySelector(`#${id}`).innerText = Math.max(parseInt(document.querySelector(`#${id}`).innerText) - 1, 1);
    }
</script>