const tooltipItems = document.querySelectorAll('.tooltiped');
const tooltip = document.getElementById('tooltip');

tooltipItems.forEach(item=>{
    item.addEventListener('mouseenter',showTooltip);
    item.addEventListener('mouseleave',hideTooltip);
})

function showTooltip(event) {
    tooltip.style.display = 'block';
}

function hideTooltip() {
    tooltip.style.display = 'none';
}

document.body.addEventListener('mousemove', event => {
    tooltip.style.top = `${event.clientY + 20}px`;
    tooltip.style.left = `${event.clientX -700}px`;
});

