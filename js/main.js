
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

    //liste des choix depand on type de bac
    var combox_type_bac=$('#typeBac');
    combox_type_bac.change(function(){
        
        var type_de_bac=$('#typeBac').val();
        
        $.get("json_data.php?choix_by_bac="+type_de_bac,function(choix,st){
            $('#choix1').empty();
            $('#choix2').empty();
            choix=JSON.parse(choix);
            $('#choix1').append('<option>liste des choix</option>');
            $('#choix2').append('<option>liste des choix</option>');
            choix.forEach(function(ch){
               
                $('#choix1').append('<option value="'+ch.IDFelier+'">'+ch.filier+'</option>');
                $('#choix2').append('<option value="'+ch.IDFelier+'">'+ch.filier+'</option>');
                
            })
        })
    })
    
    //filter chooses
    $('#choix1').change(function(){
        var type_de_bac=$('#typeBac').val();
        var choix1=$('#choix1').val();
        $.get("json_data.php?choix_by_bac="+type_de_bac,function(choix,st){
            $('#choix2').empty();
            
            choix=JSON.parse(choix);
           choix= choix.filter((val)=>val.IDFelier!=choix1);
            choix.forEach(function(ch){
               
               
                $('#choix2').append('<option value="'+ch.IDFelier+'">'+ch.filier+'</option>');
                
            })
        })
    })
})