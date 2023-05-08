function sendDataName () {
    //define data to be sent
    const data = {data: 'Onese Gachogu Irungu'};

    //send a POST request using AXIOS
    axios.post('http://localhost/voting/axios.php',data)
        .then(response =>{

            //const serverResponse = document.getElementById('server-response');
            //serverResponse.innerHTML = response.data;
            console.log(response.data);

        })

        .catch(error =>{
            console.log(error);
            console.error(error);
        });
}