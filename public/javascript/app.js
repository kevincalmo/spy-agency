
/*================================== remove one item of any table ==================================*/

const items = document.getElementById("items");

 items.addEventListener('click', (e)=>{
     
    if(e.target.className === "btn btn-danger remove-item"){
        
        if(confirm("Êtes-vous sur de votre choix ?")){
            const id = e.target.getAttribute('data-id');
            const type = e.target.getAttribute('data-type');
            fetch(`http://127.0.0.1:8000/api/${type}s/${id}`, {
                method: 'DELETE'
            }).then(res => window.location.reload());
            
        }
        
        
    }
    
    
 })

