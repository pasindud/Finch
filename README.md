<<<<<<< HEAD
#[Finch](http://github.com/pasindud)
=====

Ideamart SMS and USSD Testing framework.
***

###Note
* Test.php and testserver.php must be on the same folder.
* Goto index.html and link test.php to run the tests.
* App server URL is the test.php 

***
#### Tests  
    
        //Create Finch
    
        $opt=new Finch(App Url,App ID);
        
        Eg-:
            $opt=new Finch('http://localhost/dialog/listener.php', 'APP_000001');
        
        
        // Create SMS Tests
         $optsms->assertmatchsms(Test Name,Message Sent,Message Expected);
         
         Eg-:
            $optsms->assertmatchsms("First Message","hi start","This message is sent only to one user");
        
        
        // Create USSD Tests
        $optsms->assertmatchsms(Test Name,Message Sent,Message Expected,ussdoperation);
        
        Eg-:
            $optussd->assertmatchussd("Main Menu",'123','1. One 2. Two 99. Exit','mo-init');
        

        // Create Custom Tests
        $optussd->customTest(Test Name , Test Message, Test True for passes );
        
        Eg -:
            $optussd->customTest("Test DB","Test Works","false");

    
=======
Finch
=====
>>>>>>> d10be08fe3bf5d6f713917d00a383066820d1ab9
