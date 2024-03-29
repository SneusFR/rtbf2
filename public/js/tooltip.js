const tooltipItems = document.querySelectorAll('.tooltiped');
const tooltip = document.getElementById('tooltip');

tooltipItems.forEach(item=>{
    item.addEventListener('mouseenter',showTooltip);
    item.addEventListener('mouseleave',hideTooltip);
})

function showTooltip(event) {
    tooltip.style.opacity = '1';
    tooltip.style.transition = 'all 0.3s ease';
}

function hideTooltip() {
    tooltip.style.opacity = '0';
}

document.body.addEventListener('mousemove', event => {
    tooltip.style.top = `${event.clientY + 20}px`;
    tooltip.style.left = `${event.clientX -700}px`;
});

