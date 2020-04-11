import axios from 'axios'

const instance = axios.create({
    baseURL: 'https://aafnobachat.herokuapp.com/api/',
});

export default instance