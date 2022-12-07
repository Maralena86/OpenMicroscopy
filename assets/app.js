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

