function loadingFlight(display, text) {
    if (display == 'show') {
        $('body').append(`
        <div class="loading_fight">
            <div class="loading_fight-overlay"></div>
            <div class="loading_fight-body">
                <div class="body">
                    <span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="base">
                        <span></span>
                        <div class="face"></div>
                    </div>
                </div>
                <div class="longfazers">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <h1>${text}</h1>
            </div>
        </div>
        `)
    } else if (display == 'hide') {
        $('.loading_fight').remove();
    }
}