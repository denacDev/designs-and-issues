
/** * redirect the user to the defined page.
* @param {*} container where the message will show 
* * .class  /  #id  
* * !!!  simbol required
* @param {*} type what type of msg is this ?  
* *  info 
* *  warning 
* *  success 
* *  error 

* @param {*} action what is the msg for ?  
* *  add-design / delete-design / edit-design 
* *  add-issue / delete-issue / edit-issue / check-issue
* *  user-not-logged
* @param {*} page where to redirect - used in setUrl(__) function
* * login-page - index.php
* * designs    - index_two.php?page=designs
* * issues     - index_two?page=issues&design_id=${design_id}
* * edit_issue - index_two?page=issues&design_id=${design_id}&open_issue=${issue_id}
* @param {*} design_id - self explanatory
* @param {*} issue_id - self explanatory
 */
function redirect(container, type, action, page, design_id, issue_id ){
    
    let error = false; 

    // 1. set action
    switch(action){
        //designs
        case 'add-design':       txt = `Added new <i class='custom-msg'>Design</i>, redirecting...`;  break;
        case 'delete-design':    txt = `Deleted Design with id: <i class='custom-msg'>${design_id}</i>, redirecting...`;  break;
        case 'edit-design':      txt = `Edited design with id: <i class='custom-msg'>${design_id}</i>, redirecting...`;  break;
        //issues
        case 'add-issue':        txt = `Added new <i class='custom-msg'>Issue</i>, redirecting...`;  break; 
        case 'delete-issue':     txt = `Deleted Issues with id:  <i class='custom-msg'>${issue_id}</i>, redirecting...`;  break;
        case 'edit-issue':       txt = `Eddited issue with id:  <i class='custom-msg'>${issue_id}</i>, redirecting...`;  break;
        case 'check-issue':      txt = `Issue with id:  <i class='custom-msg'>${issue_id}</i> has been checked, refreshing...`;  break;
        //user not logged
        case 'user-not-logged':  txt = `Error user not found <i class='custom-msg'>Issue</i>, redirecting... to ${page}`;  break;
       
        default: error = true;   txt = `ERROR:: Javascript  REDIRECT query:  action='<strong  class='warning-msg'>${action}</strong>' is not valid. `;
    }

       // 2.  create the msg
       newMsg =  buildMsg(type, txt);
    
       // 3.  add the msg to the dom
           addToDom(container,  newMsg)  
   
       // 4. set url
           newUrl = setUrl(page, design_id, issue_id); 
   if ( error !== true){ 
        // 5. redirect to page
             setTimeout(() => {  window.location.href = newUrl;  },2300);   
   }  
}





/**
    * @param {*} container where the message will show 
    * * .class  /  #id  
    * * !!!  simbol required
    * @param {*} type what type of msg is this ?  
    * *  info 
    * *  warning 
    * *  success 
    * *  error 

    * @param {*} action what is the msg for ?  
    * *  add-ok / add-fail 
    * *  edit-ok / edit-fail 
    * *  delete-ok / delete-fail 
    * *  check-ok / check-fail 
    * *  privilege  / fail
    * @param {*} value custom text  
*/
function msg(container, type, action, value ){
 
    



    // 1. set the action
        switch (action){

            // add type
            case 'add-ok':       txt = `Added new <i class='custom-msg'>${value}</i>.`;          break; 
            case 'add-fail':     txt = `Failed to add new <i class='custom-msg'>${value}</i>.`;  break;

            // edit type
            case 'edit-ok':      txt = `Edited the <i class='custom-msg'>${value}</i>.`;             break;
            case 'edit-fail':    txt = `Failed to edit <i class='custom-msg'>${value}</i>.`;     break;

            
            // Delete type
            case 'delete-ok':    txt = `Deleted the <i class='custom-msg'>${value}</i>.`;           break;
            case 'delete-fail':  txt = `Failed to delete <i class='custom-msg'>${value}</i>.`;  break;
            
            // check type
            case 'check-ok':     txt = `Issue with id:  <i class='custom-msg'>${value}</i> has been checked.`;   break;
            case 'check-fail':   txt = `Failed to check issue with id:  <i class='custom-msg'>${value}</i>.`;   break;
            
            //privilege
            case 'privilege':    txt = `Not allowed to <i class='custom-msg'>${value}</i>.`;     break; 

             //generic
            case 'fail':         txt = `Error  <i class='custom-msg'>${value}</i> and try again `;  break;

            default:             txt = `ERROR:: Javascript MSG QUERY:  action='<strong  class='warning-msg'>${action}</strong>' is not valid. `; break;

        }


         
    // 2.  create the msg
        newMsg =  buildMsg(type, txt);

    // 3.  add the msg to the dom
        addToDom(container,  newMsg) 
}




//HELPER FUNCTIONS

    /** * set's the url to go to when redirected
 * this function is used by  used by redirect(__) function
 *
 * @param {*} page where to redirect - used in setUrl(__) function
 * * login-page - index.php
 * * designs    - index_two.php?page=designs
 * * issues     - index_two?page=issues&design_id=${design_id}
 * * edit_issue - index_two?page=issues&design_id=${design_id}&open_issue=${issue_id}
 * @param {*} design_id- self explanatory
 * @param {*} issue_id- self explanatory
 * @returns
 */
    function setUrl(page, design_id,issue_id){
    
    // 1. set the URL
    switch(page){

        case 'login-page':   newUrl = `index.php`;   break;
        
        case 'designs':   newUrl = `index_two.php?page=designs`;   break;


        case 'issues': 
            if (design_id != ''){newUrl = `index_two?page=issues&design_id=${design_id}`;}
            else{newUrl = `ERROR:: Javascript SET-URL query:  design_id='<strong  class='warning-msg'>${design_id}</strong>' is not valid. `;} 
        break;
        case 'edit_issue':  
            if (design_id != '' && issue_id != ''){newUrl = `index_two?page=issues&design_id=${design_id}&open_issue=${issue_id}`;}
            else{
                newUrl = `ERROR:: Javascript SET-URL query:  
                            design_id='<strong  class='warning-msg'>${design_id}</strong>' //
                            issue_id='<strong  class='warning-msg'>${issue_id}</strong>' 
                            is not valid. `;
            } 
        break;
         

        default: newUrl = `ERROR:: Javascript SET-URL query:  page='<strong  class='warning-msg'>${page}</strong>' is not valid. `;
    }
    
      return newUrl ; 

    }

 
    function buildMsg(type, txt){

        // 1. create new DOM element  as a msg container
        let div = document.createElement('div'); 

        // 2. add a class to it 
        div.classList.add('temp-msg');
        
        
        if(type !== ''){  }

        switch(type){
            case 'info':    newSpan =  `<span class=' info-msg'> ${txt}  </span>`; break;
            case 'warning': newSpan =  `<span class=' warning-msg'> ${txt}  </span>`; break;
            case 'success': newSpan =  `<span class=' success-msg'> ${txt}  </span>`; break;
            case 'error':   newSpan =  `<span class=' error-msg'> ${txt}  </span>`; break;
            default: newSpan =  `<span class='error-msg'> ERROR:: Javascript BUILD-MSG:  type='<strong class='warning-msg'>${type}</strong>' is not valid.  </span>`; break;
        }

    

        // 3. add the msg to msg container
    
        div.innerHTML = newSpan; 

        // 4. return the message
        return div;

    }


    function addToDom(container, newMsg){

    //container is the location where the msg will be displayed
        
        // 1.  get target container where to put the tempmsg div
            let msgContainer = document.querySelector(`${container}`); 
        // 2.  check if the container exists on the DOM    
            if (!msgContainer){  newMsg = `<span class='error-msg'> ERROR:: Javascript ADD-TO-DOM:  container='<strong  class='warning-msg'>${container}</strong>' not found on the DOM.  </span>`;  } 
        
 

        // 3.  add the msg container to the DOM container ( as 2nd child because 1st is the text of the container itself)
          msgContainer.insertBefore(newMsg, msgContainer.childNodes[2]);
        
          // get all messages
        let tempMsg = document.querySelector('.temp-msg');
        
         
        //4.  remove after specified time 
        setTimeout(() => {    msgContainer.removeChild(tempMsg);  },2300); 
       
        
    }









 