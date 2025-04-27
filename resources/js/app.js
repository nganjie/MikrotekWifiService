import './bootstrap';
import Echo from 'laravel-echo'

let e= new Echo({
    broadcaster: 'socket.io',
    host:'http://127.0.0.1:6001', // Laravel Echo Server URL
})