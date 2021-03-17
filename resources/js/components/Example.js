import React from 'react';
import ReactDOM from 'react-dom';

function Example({data}) {
    const user = JSON.parse(data)
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>

                        <div className="card-body">I'm an example component! I'm {user.name}</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    var data = document.getElementById('example').getAttribute('data');
    ReactDOM.render(<Example data={data}/>, document.getElementById('example'));
}
