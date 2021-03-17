import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom';
import "./Flash.css";

function Flash({ data }) {
    const message = JSON.parse(data);
    const [show, setShow] = useState(true);
    useEffect(() => {
        setTimeout(() => {
            setShow(false);
        }, 2000);
    }, [])
    return (
        <div>
            <div className ={`alert alert-${message.type.tolowerCase()} flash-alert ${ show ? '' :' d-none'}`} role="alert" >
                <strong>{message.type}! </strong> {message.body}
            </div>

        </div>
    )
}

export default Flash;

if (document.getElementById('flash')) {
    var data = document.getElementById('flash').getAttribute('data');
    ReactDOM.render(<Flash data={data} />, document.getElementById('flash'));
}
