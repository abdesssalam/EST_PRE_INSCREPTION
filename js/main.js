
$(document).ready(function(){
    // filtr villes by regions
    $('#region-etd').change(function(){
        
        var reg_etd =$('#region-etd').val();

        $.get("json_data.php?reg_id="+reg_etd,function(villes,st){
                $('#ville-etd').empty();
                villes=JSON.parse(villes);
                villes.forEach(function(ville){ 
                    $('#ville-etd').append('<option value="'+ville.id+'">'+ville.ville+'</option>')
                });  
        })
    })
    
    //filter chooses
    $('#choix1').change(function(){
       
        var choix1=$('#choix1').val();
        $.get("json_data.php?choix_id="+choix1,function(choix,st){
           $('#choix2').empty();
            choix=JSON.parse(choix);
            
            choix.forEach(function(ch){
               
                $('#choix2').append('<option value="'+ch.IDFelier+'">'+ch.intitilue+'</option>');
                
            })
        })
    })
})