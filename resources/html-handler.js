document.addEventListener('DOMContentLoaded', function() {
    function toggle() {
        let container = this.nextSibling;
        while (!container.classList.contains('vd-container')) {
            container = container.nextSibling;
        }

        let dots = this;
        while (!dots.classList.contains('vd-dots')) {
            dots = dots.previousSibling;
        }

        let node = this;
        while (!node.classList.contains('vd-node')) {
            node = node.nextSibling;
        }

        if (this.classList.contains('vd-expanded')) {
            node.classList.remove('vd-expanded');
            node.classList.add('vd-collapsed');

            dots.classList.remove('vd-expanded');
            dots.classList.add('vd-collapsed');

            container.classList.remove('vd-container-open');
            container.classList.add('vd-container-close');

            return;
        }

        node.classList.remove('vd-collapsed');
        node.classList.add('vd-expanded');

        dots.classList.remove('vd-collapsed');
        dots.classList.add('vd-expanded');

        container.classList.remove('vd-container-close');
        container.classList.add('vd-container-open');
    }
    for (let element of document.getElementsByClassName('vd-dots')) {
        element.onclick = toggle;
    }
    for (let element of document.getElementsByClassName('vd-node')) {
        element.onclick = toggle;
    }
});