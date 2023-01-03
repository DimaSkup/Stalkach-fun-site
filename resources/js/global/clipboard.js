const clipboardItems = document.querySelectorAll("[data-action='copy']");
clipboardItems.forEach(item => {
    item.tooltip = new mdb.Tooltip(item, {
        trigger: 'manual',
        title: item.title || 'Copied to clipboard'
    });
});

const clipboard = new ClipboardJS(clipboardItems);
clipboard.on('success', function(e) {
    e.trigger.tooltip.show();
    e.clearSelection();
    setTimeout(() => {
        e.trigger.tooltip.hide();
    },1000);
});