const user = document.getElementById('show');
const side = document.getElementById('side');

user.addEventListener('click', () => {
    const show = document.getElementById('dropdown');
    
    show.removeAttribute('hidden');
    show.style.display = 'flex';
    
});

const nn = document.querySelectorAll('[hidden]');
if (typeof sort !== 'undefined') {
    var ara = [user, sort];
}else {   
    var ara = [user];  
}


window.onclick = function(event) {

    if (nn.length >= 1) {
        for (let i = 0; i < nn.length; i++) {
            if (!(event.target == ara[i]) && !(ara[i].hidden)) {
                    nn[i].removeAttribute('style');
                    nn[i].setAttribute('hidden', '');              
            }   
        }
    } 
};

function clicks(){
    
    let sItems = document.querySelector('.side-items');   
    let cls = sItems.classList;
    const tt = cls.toggle('x');
}

let t = document.getElementsByClassName('t');
for (var i = 0; i < t.length; i++){ 
    t[i].addEventListener('click', clicks);  
        
}








