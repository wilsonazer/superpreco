
//Carrossel de categorias da pagina index 
  
    $(function() {
         var qtd = 3;
         var largura = $(window).width(); 
         
         if(largura <= 480){
            qtd = 1;
        }else if(largura > 480 && largura <= 800){
             qtd = 2;
        }else{
            qtd = 3;
            
        };
    
$(".carrossel_home").jCarouselLite({
        auto: 8000,
        circular: false,
        btnNext: '.carrossel_home .next',
        btnPrev: '.carrossel_home .prev',
        overflow: 'hidden',
        speed: 1500,
        scroll: 1,
        visible: qtd
});

 
 });
 
 

 
 
        
               
              


