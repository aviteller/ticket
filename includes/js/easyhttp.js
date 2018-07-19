/**
 * 
 * EasyHttp Libaray
 * Libary fro making http requests
 * 
 * @version 3.0.0
 * @author Avi Teller
 * @license MIT
 * 
 */

class EasyHttp {
  //Make HTTP get request
  async get(url) {
    const response = await fetch(url);
    const resData = await response.json();

    return resData;
  }

  //Make Http Post Request

  async post(url, data) {
    //console.log(url, data);
     const response = await fetch(url, {
       method: 'POST',
       headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
       },
       body: JSON.stringify(data)
     });
    const resData = await response.json();
    return resData;

  }


   //Make Http Put Request

   async put(url, data) {
    const response = await fetch(url, {
      method: 'PUT',
      headers: {
        'Content-type':'application/json'
      },
      body: JSON.stringify(data)
    });
    const resData = await response.json();
    return resData;

  }

    
   //Make Http Delete Request

   async delete(url) {
    const response = await fetch(url, {
      method: 'DELETE',
      headers: {
        'Content-type':'application/json'
      },
      body: JSON.stringify(data)
    });
    const resData = await 'Resource deleted';
    return resData;

  }


  }