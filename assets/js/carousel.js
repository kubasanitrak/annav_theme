(function(){
    const initializeBlock = function (block) {
        // let _groupNum = '<?php echo $GROUP_BY_NUM; ?>';
            // _groupNum = parseInt(_groupNum);
        let _groupNum = 1;
        const _carousel = block;
        // console.log("_groupNum: " + _groupNum);

        // Initialize Flickity with options
        new Flickity(_carousel, {
            // imagesLoaded: true, // re-positions cells once their images have loaded
            // groupCells: true, // group cells that fit in carousel viewport
            // cellAlign: _carousel.dataset.cellalign,
            // freeScroll: true, // enables content to be freely scrolled and flicked without aligning cells to an end position
            // wrapAround: _carousel.dataset.wraparound
            wrapAround: true,
            arrowShape: 'm6 50 39.97 40 8.045-8.078-29.198-27.753c3.114.912 8.565 1.434 14.794 1.434H91V44.397H39.61c-6.228 0-11.679.522-14.793 1.564l29.198-27.883L45.97 10 6 50Z',
            pageDots: true,
            groupCells: _groupNum,
            cellAlign: 'left',
        });
    };

    // Initialize each block on page load (front end).
    document.addEventListener('DOMContentLoaded', () => {
        let _selector = '<?php echo $CLS_SELECTOR; ?>';

// console.log(_selector);

        // const flickityBlocks = document.querySelectorAll('.carousel');
        const flickityBlocks = document.querySelectorAll(_selector);
        flickityBlocks.forEach(block => {
            initializeBlock(block);
        });
    });

    // Initialize dynamic block preview (editor).
    if (window.acf) {
        window.acf.addAction('render_block_preview/type=flickity', initializeBlock);
    }
})();