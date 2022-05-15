async function getData(url) {

    try{
        const response = await fetch('http://localhost/plan');
        return await response.json();

    }
    catch(err){
        console.error(err);
    }
    
}
