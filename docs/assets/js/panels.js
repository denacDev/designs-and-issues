
// MAIN FUNCTION
 
    /** * open the body of a design/issue
    *
    *
    * @param {*} pnl - panel body to be open
    * @param {*} button - button that was pressed
    */
    function openBody(pnl, button){ 

            //used in changeButton()
            let panelCheck = false;


            //1. get dropdown panel element
            let panel = document.querySelector(`#${pnl}`); 

        

            //2.A if the panel(single) is active
            if (panel.classList.contains("activate-dropdown")){

                    //5.A if button is pressed again hide the panel(single)
                    panel.classList.remove('activate-dropdown');
                    panelCheck = true;


            //2.B if the panel(single) is not active
            } else {

                    //3.A if the current panel is an issue panel 
                    if (panel.classList.contains("primary-component-issue-body")){
                            // get all issue pannels
                            let allpanels = document.querySelectorAll('.primary-component-issue-body');
                            
                            var i;
                            for (i = 0; i < allpanels.length; i++) {
                                //4.A close them all 
                                allpanels[i].classList.remove('activate-dropdown'); 
                            }
                    }

                    //3.B if the current panel is an desogm panel
                    if (panel.classList.contains("primary-component-design-body")){
                            // get all issue pannels
                            let allpanels = document.querySelectorAll('.primary-component-design-body');
                        
                            var i;
                            for (i = 0; i < allpanels.length; i++) {
                                //4.B close them all 
                                allpanels[i].classList.remove('activate-dropdown'); 
                            }
                    }


                    //5. open the body of the selected(single)
                    panel.classList.add("activate-dropdown"); 
                    panelCheck = false; 
            }


            //6. panel check is saying to change button shape/color if the body of design/issue open or not.
            changeButton(button, panelCheck)

    }

    
//HELPER FUNCTION

    /** * change button's shape/color based on panel check
     *
     *
     * @param {*} button - button that was pressd
     * @param {*} panelCheck - panel that is open/closed
     */
    function changeButton(button, panelCheck){
        //1. get button
        let btn = document.querySelector(`#${button}`);

        //2. get buton children ( to change the lines)
        let firstChild = btn.firstElementChild;
        let lastChild = btn.lastElementChild;

        //3.A if panel is open
        if (panelCheck == true) {
                //4.A set the icon of the button to be "-"(minus)
                firstChild.removeAttribute( "style", "transform: rotate(90deg); left: 50%;right: 50%;"); 
                lastChild.removeAttribute( "style", "display:none;");

                //5. if the button is an issue button, make it white;
                if (btn.classList.contains('issue-dropdown-button')){
                    firstChild.setAttribute( "style", "  background-color:white;");
                    lastChild.setAttribute( "style", "  background-color:white;"); 
                }


        //3.B if panel is closesd
        }else{
                //4. if the button is an issue button, make it a "+" and make it white;
                if (btn.classList.contains('issue-dropdown-button')){
                    firstChild.setAttribute( "style", " transform: rotate(90deg);left: 50%;right: 50%;  background-color:white;");
                    lastChild.setAttribute( "style", " display:none; ");
                    
                //4.B if the button is an design button, make it a "+" s
                }else{
                    firstChild.setAttribute( "style", "transform: rotate(90deg);left: 50%;right: 50%;  ");
                    lastChild.setAttribute( "style", "display:none;");

                }


        }
    }