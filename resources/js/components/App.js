import React from 'react';
import ReactDOM from 'react-dom';
import Attendance from "./Attendance/Attendance";

function App() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <Attendance/>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default App;


