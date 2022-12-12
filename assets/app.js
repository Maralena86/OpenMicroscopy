// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
// start the Stimulus application
import './bootstrap';

document.addEventListener('DOMContentLoaded', ()=>{
    new App()
})


const hamburguer =document.querySelector(".hamburguer");
const navMenu = document.querySelector(".nav-menu");
hamburguer.addEventListener('click', ()=>{
    hamburguer.classList.toggle("active");
    navMenu.classList.toggle("active");
})

class App {
    constructor(){
        this.handleCommentForm();
    }

    handleCommentForm(){
        const commentForm = document.querySelector('form.form-comment');
        if(null === commentForm){
            return;
        }
        commentForm.addEventListener('submit', async (e)=>{
            e.preventDefault();
            const response = await fetch ('/ajax/comment', {
                method: 'POST',
                body: new FormData(e.target)
            });
            if(!response.ok){
                return;
            }
            const json = await response.json();
            if(json.code === 'COMMENT_ADDED_SUCCESS'){
                const commentList = document.querySelector('.comment-list');
                const commentCount = document.querySelector('.comment-count');
                const commentContent = document.querySelector('.comment-content');
                commentList.insertAdjacentHTML('beforeend', json.message);
                commentList.lastElementChild.scrollIntoView();
                commentCount.innerText = json.numberOfComments;
                commentContent.value = '';

            }
        })
    }
}

// gsap.registerPlugins(ScrollTrigger);

// gsap.utils.toArray(".revealUp").forEach(function(elem){
//     ScrollTrigger.create({
//         trigger: elem,
//         start: "top 80%",
//         end: "bottom 20%",
//         markers: true,
//         onEnter: function (){
//             gsap.fromTo(
//                 elem, 
//                 {y:100, autoAlpha:0},
//                 {
//                     duration: 1.25,
//                     y:0,
//                     autoAlpha:1,
//                     ease: "back",
//                     overwrite: "auto"

//                 }
//             );
//         },
//         onLeave: function (){
//             gsap.fromTo(
//                 elem,
//                 {y: -100, autoAlpha: 0},
//                 {
//                     duration:1.25,
//                     y:0,
//                     autoAlpha:1,
//                     ease: "back",
//                     overwrite: "auto"
//                 }
//             );
//         },
//         onLeaveBack: function (){
//             gsap.fromTo(elem, {autoAlpha:1}, {autoAlpha:0, overwrite: "auto"});
//         }
//     });
// });



const api = "924f6460e9e14b159153490f6ada08fb"