const progressBar = document.getElementById("progress-bar");

if(progressBar) {
    document.addEventListener('scroll', () => {
        let docElem = document.documentElement,
            docBody = document.body,
            scrollTop = docElem['scrollTop'] || docBody['scrollTop'],
            scrollBottom = (docElem['scrollHeight'] || docBody['scrollHeight']) - window.innerHeight,
            scrollPercent = scrollTop / scrollBottom * 100 + '%';
        progressBar.style.setProperty("--scrollAmount", scrollPercent);
    });
}
