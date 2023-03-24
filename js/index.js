
    

    function toggleClass(){
        var Datee = document.getElementById('withDate');
        var Name = document.getElementById('byName');
        var schedule = document.getElementById('schedule');
        var trains = document.getElementById('trains');
       // var way1 = document.getElemenetById('way1');
      //  var way2 = document.getElemenetById('way2');
        schedule.classList.add('show');
        trains.classList.remove('show');
      
        if(Datee.classList=='show'){
            Datee.classList.remove('show');
            Name.classList.add('show');
            document.getElementById("way1").classList.add("tag-btn", "active-tag");
            document.getElementById("way2").classList.remove("active-tag");        }
        

    }
    function toggleClass1(){
        var Datee = document.getElementById('withDate');
        var Name = document.getElementById('byName');
        var schedule = document.getElementById('schedule');
        var trains = document.getElementById('trains');

        schedule.classList.remove('show');
        trains.classList.add('show');
        if(Name.classList=='show'){
            Name.classList.remove('show');
            Datee.classList.add('show');
            document.getElementById("way2").classList.add("tag-btn", "active-tag");
            document.getElementById("way1").classList.remove("active-tag");
        }
        

    }

    function ItoggleClass(){
        var Datee = document.getElementById('withDate');
        var Name = document.getElementById('byName');
        
       // var way1 = document.getElemenetById('way1');
      //  var way2 = document.getElemenetById('way2');
        
      
        if(Datee.classList=='show'){
            Datee.classList.remove('show');
            Name.classList.add('show');
            document.getElementById("way1").classList.add("tag-btn", "active-tag");
            document.getElementById("way2").classList.remove("active-tag");        }
        

    }
    function ItoggleClass1(){
        var Datee = document.getElementById('withDate');
        var Name = document.getElementById('byName');
        

        
        if(Name.classList=='show'){
            Name.classList.remove('show');
            Datee.classList.add('show');
            document.getElementById("way2").classList.add("tag-btn", "active-tag");
            document.getElementById("way1").classList.remove("active-tag");
        }
        

    }
