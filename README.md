#PREQUISITES
---

## #`IMPORTANT` 
> * This exercise is complete and please pay attention to all the interface to understand it before in order to experience the full ride.

## #`Load the database` 

> * [[exercise.sql]]  database file - docs/assets/


#DETAILS
---

**Small project showcasing Front-end / Back-end skills**
The project is based on a interview exercise requirement which asks the developer to use technologies like:
[[#CSS]] / [[#JAVASCRIPT]] / [[#PHP]]

### **THE PLOT**

- Create a PHP **[[CRUD]]** SYSTEM for the provided database
### **THE RULES**



|ENGINEER                    |  SENIOR ENGINEER                             |
|----------------------------|:--------------------------------------------:|
|***YES***:: can add issues  |***YES***:: add designs/issues                | 
|***NO***:: add designs      |***NO***:: check issues                       |
|***NO***:: check designs    |***NO***:: check the created issue by himself |
   
 
| ALL USERS |
|-----------|
|***NO***:: Delete a design if there are issues in the database [DONE]|
 
 




# FILES
---



 
## #`Javascript` 

> * [[panels.js]] This file deals with all panels of either designs / issues
changes the corner button from + to - ( to indicate that a body panel is open)
 
> * [[messages.js]] This file contains **the project wide** [`message system`], whatever message pops up on the website, this is the file dealing with it.

 



## #`PHP` 

 There are 3 classes for the entire project
> * [[database.php]]::`parent class` - connects to the database and ... that is it.


> * [[system.php]]::`child of`[[database]] class
>>    >**MSG part**
>>>    * newMsg()   - Show a msg on the DOM using javascript
>>>    * redirect() - Show a msg on the DOM using javascript and redirect the page


>>    >**CLEAN part**
>>>    * freeMemory()   - Release results from memory after use
>>>    * sanitizeData() - cleans users input data


>>    >**MISC part**
>>>    * openBody()     - opens the body of an desing/ issue based on their id ( it is using the javascript function)
>>>    * dateMod()      - modifies the date comming from DB because it comes with time( i need only the date)
>>>    * show_designs() - show all designs in the database
>>>    * show_issues()  - show all issues in the database
>>>    * getTable()     - get one/multiple values from a specific table 


> * [[user.php]]::`child of`[[system]] class 
>>    >**USER DETAILS part**
>>>    * get_user_details()   - get user all/specific details  
>>>    * get_user_job_title() - get user job title based on the logged user id

>>    >**CONTROL THE DESIGNS part**
>>>    * addDesign() - add a new design to DB
>>>    * editDesign()   - edit a   design  
>>>    * deleteDesign() - delete a   design from DB

>>    >**CONTROL THE ISSUES part**
>>>   * addIssue()    - add a new issue to DB
>>>   * editIssue()   - edit a   issue 
>>>   * deleteIssue() - delete a   issue from DB
>>>   * checkIssue()  - set a issue as checked.

  




# FEATURES OF THE PROJECT
---











#####[[ System wide ]]
>> + FREE MEMORY wherenever a databse object is called
  
#####[[ Designs Panel ]]
>> + Show *static*(not moving) animated msg if there is no design in db
>> + After a design has been [[edited]]  - the user is sent back to the single design view and opens the same design that was edited.

#####[[ Issues Panel ]]
>> + Show *static*(not moving) animated msg if there is no issue in db for the selected design.
>> + After a issue has been [[edited]]  - the user is sent back to the single design view and opens the same issue that was edited.

#####[[ Issue panel > check button ]]

>>  ENGINEER 
>>- **CANNOT** CHECK any issue

>>  SENIOR ENGINEER 
>> + *issue created by the logged in senior*
>>    + **LABEL**: "*[[not checked]]*" 
>>    + **BTN**:  "*[[Created by you Cannot check]]*"
>> + issue created by a different senior
>>    + **LABEL**: "*[[not checked]]*" 
>>    +  **BTN**:  "[[CHECK]]"
>> + issue has been checked already 
>>    + **LABEL**: "*[[CHECKED]]*"     
>>    + **BTN**:  "[[N/A]]"
        
 
#####[[ Cancel button ]] 
- opens the body of the same issue that was intended to be modified/deleted.

#####[[ Edit button ]] 
- opens the body of the same issue that waS MODIFIED
