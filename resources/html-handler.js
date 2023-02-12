document.addEventListener('DOMContentLoaded', function() {
    function toggle() {
        let container = this.nextSibling;
        while (!container.classList.contains('var-dumper-container')) {
            container = container.nextSibling;
        }

        let dots = this;
        while (!dots.classList.contains('var-dumper-dots')) {
            dots = dots.previousSibling;
        }

        let node = this;
        while (!node.classList.contains('var-dumper-node')) {
            node = node.nextSibling;
        }

        if (this.classList.contains('var-dumper-expanded')) {
            node.classList.remove('var-dumper-expanded');
            node.classList.add('var-dumper-collapsed');

            dots.classList.remove('var-dumper-expanded');
            dots.classList.add('var-dumper-collapsed');

            container.classList.remove('var-dumper-container-open');
            container.classList.add('var-dumper-container-close');

            return;
        }

        node.classList.remove('var-dumper-collapsed');
        node.classList.add('var-dumper-expanded');

        dots.classList.remove('var-dumper-collapsed');
        dots.classList.add('var-dumper-expanded');

        container.classList.remove('var-dumper-container-close');
        container.classList.add('var-dumper-container-open');
    }
    for (let element of document.getElementsByClassName('var-dumper-dots')) {
        element.onclick = toggle;
    }
    for (let element of document.getElementsByClassName('var-dumper-node')) {
        element.onclick = toggle;
    }
});