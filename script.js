$(document).ready(function(){

    function reduceFunc(){
        var sidenav = document.getElementById('sidenav');
        var main = document.getElementById('main');
        const navHead = document.querySelectorAll('.navHead');
        var brandName = document.getElementById('brandName');
        var profileName = document.getElementById('profileName');
        var menuIcon = document.getElementById('menuIcon');
        var menuIcon2 = document.getElementById('menuIcon2');
        var officeOptLink = document.querySelectorAll('.officeOptLink');
        var profileOpt = document.querySelector('.profileOpt');

        sidenav.style.width="65px";
        profileOpt.style.left="65px";
        main.style.marginLeft="65px";
        brandName.style.display="none";
        profileName.style.display="none";
        menuIcon.style.display="none";
        menuIcon2.style.display="block";

        navHead.forEach(function(element){
            element.style.display="none";
        })

        officeOptLink.forEach(function(element){
            element.style.display="none";
        })
    }

    // EXPAND PROFILE OPTIONS DIV
    $('.profilePicDiv').click(function(){
        var profileOpt = document.querySelector('.profileOpt');

        profileOpt.classList.toggle('scale');
    })

    document.getElementById('menuIcon').addEventListener('click', function(){
        reduceFunc();
    });

    function expandFunc(){
        var sidenav = document.getElementById('sidenav');
        var main = document.getElementById('main');
        const navHead = document.querySelectorAll('.navHead');
        var brandName = document.getElementById('brandName');
        var profileName = document.getElementById('profileName');
        var menuIcon = document.getElementById('menuIcon');
        var menuIcon2 = document.getElementById('menuIcon2');
        var officeOptLink = document.querySelectorAll('.officeOptLink');
        var profileOpt = document.querySelector('.profileOpt');

        sidenav.style.width="200px";
        profileOpt.style.left="200px";
        main.style.marginLeft="200px"
        brandName.style.display="block";
        profileName.style.display="block";
        menuIcon.style.display="block";
        menuIcon2.style.display="none";

        navHead.forEach(function(element){
            element.style.display="block";
        })

        officeOptLink.forEach(function(element){
            element.style.display="block";
        })
    }
    
    document.getElementById('menuIcon2').addEventListener('click', function(){
        const width = window.innerWidth;
        var sidenav = document.getElementById('sidenav');
        const navHead = document.querySelectorAll('.navHead');
        var brandName = document.getElementById('brandName');
        var profileName = document.getElementById('profileName');
        var officeOptLink = document.querySelectorAll('.officeOptLink');
        var profileOpt = document.querySelector('.profileOpt');
        
        if(width <= 500){
            sidenav.style.left="0px";
            sidenav.style.width="200px";
            profileOpt.style.left="200px";
            brandName.style.display="block";
            profileName.style.display="block";

            navHead.forEach(function(element){
                element.style.display="block";
            })

            officeOptLink.forEach(function(element){
                element.style.display="block";
            })
        }
        else{
            expandFunc();
        }
    });

    // CLOSE SIDEBAR ON SMALL SCREENS
    document.getElementById('closeBtn').addEventListener('click', function(){
        var sidenav = document.getElementById('sidenav');
        sidenav.style.left="-250px";
    })

    

    // SIDEBAR ADJUSTMENT ON WINDOW RESIZE
    function windowResize(){
        const width = window.innerWidth;
        var sidenav = document.getElementById('sidenav');
        var main = document.getElementById('main');
        const navHead = document.querySelectorAll('.navHead');
        var brandName = document.getElementById('brandName');
        var profileName = document.getElementById('profileName');
        var officeOptLink = document.querySelectorAll('.officeOptLink');
        var profileOpt = document.querySelector('.profileOpt');

        if(width <= 500){
            sidenav.style.left="-250px";
            // profileOpt.style.left="0px";
            main.style.marginLeft="0px";
        }
        else if(width <= 1060){
            sidenav.style.left="0px"
            sidenav.style.width="65px";
            profileOpt.style.left="65px";
            main.style.marginLeft="65px";
            brandName.style.display="none";
            profileName.style.display="none";
            menuIcon.style.display="none";
            menuIcon2.style.display="block";

            navHead.forEach(function(element){
                element.style.display="none";
            })

            officeOptLink.forEach(function(element){
                element.style.display="none";
            })
        }
        else{
            sidenav.style.width="200px"
            profileOpt.style.left="200px";
            main.style.marginLeft="200px"
            brandName.style.display="block";
            profileName.style.display="block";
            menuIcon.style.display="block";
            menuIcon2.style.display="none";

            navHead.forEach(function(element){
                element.style.display="block";
            })

            officeOptLink.forEach(function(element){
                element.style.display="block";
            })
        }
        
    }

    window.addEventListener('resize', function(){
        windowResize();
    });

    // TOGGLE TABLE
    $('#minus').click(function(){
        $('#orderedDetails').slideToggle();
        document.getElementById('minus').classList.toggle('rotate');
    });

    $('#deliveredminus').click(function(){
        $('#deliveredDetails').slideToggle();
        document.getElementById('deliveredminus').classList.toggle('rotate');
    });

});
