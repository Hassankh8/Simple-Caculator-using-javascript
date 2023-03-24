     
  //    Remove Class "active" from sidebar elements
  //    Add Class "active" to the clicked element
  var nav_item = document.querySelectorAll('.nav-list ul li a');
  [].forEach.call(nav_item, function(item) {
      item.addEventListener('click', function() { 
          
          var clickeditem  = item.parentNode.childNodes[0];
          var anchor       = clickeditem.getAttribute('data-page');
          var page_name    = document.querySelector('[data-content='+ anchor +']');
          var active_page  = document.querySelector('.page-wrapper .page-content .active');
          var active_class = document.querySelector('.nav-list ul li .active');
          
          //adding active class to the clicked anchor
          active_class.classList.remove('active');
          clickeditem.classList.add('active');
          
          //adding active class to the target page
          if(page_name !== null) { 
              active_page.classList.remove('active');
              active_page.classList.add('hidden');
              
              page_name.classList.remove('hidden');
              page_name.classList.add('active');
          }else{
              active_page.classList.remove('active');
              active_page.classList.add('hidden');
              
              document.querySelector('[data-content=err-404]').classList.remove('hidden');
              document.querySelector('[data-content=err-404]').classList.add('active');
          }
      });
  
  });

  //Open & Close Sidebar
  $('.menu-btn').on('click', function(){
      $('.container').toggleClass('sb-open');
      $('.overlay').toggleClass('show');
  });