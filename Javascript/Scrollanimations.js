let tl = gsap.timeline({
    scrollTrigger: {
        trigger: ".holder",
        start: "5% top",
        end: "55% 50%",
        scrub: false,
        markers: false
    }
});

tl.to(".holder", {
    yPercent: -45,
    rotation: 360,
    scale: 0.1,
    duration: 1.0,
})


// Lenis smooth scroll
const lenis = new Lenis()

lenis.on('scroll', (e) => {
    console.log(e)
})

function raf(time) {
    lenis.raf(time)
    requestAnimationFrame(raf)
}

requestAnimationFrame(raf)