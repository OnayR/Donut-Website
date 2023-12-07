// let tl = gsap.timeline({
//     scrollTrigger: {
//         trigger: ".holder",
//         start: "5% top",
//         end: "55% 50%",
//         scrub: false,
//         markers: false
//     }
// });

// tl.to(".holder", {
//     xPercent: 50,
//     rotation: 360,
//     scale: 0.7,
//     duration: 1.0,
// })


let tl2 = gsap.timeline({
    scrollTrigger: {
        trigger: ".primary-bar-background",
        start: "80% top",
        end: "500 50",
        scrub: false,
        markers: false
    }
});

tl2.to(".primary-bar-background", {
    yPercent: -100,
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