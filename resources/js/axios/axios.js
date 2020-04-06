import axios from 'axios'

const instance = axios.create({
    baseURL: 'https://aqueous-tor-49981.herokuapp.com/api/',
});

export default instance