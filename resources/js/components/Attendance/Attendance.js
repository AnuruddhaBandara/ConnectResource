import Axios from 'axios';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import FileUpload from "./FileUpload";

class Attendance extends Component {

    constructor(props) {
        super(props);

        this.state = {
            attendancelist: [],
        }
    }

    componentDidMount() {
        this.getAttendanceList();

    }

    //get attendance list
    getAttendanceList() {
        Axios.get('api/attendance-list').then((response) => {
            this.setState({
                attendancelist: response.data
            });
        });
    }

    render() {
        return (
            <div className="container">
                <FileUpload/>
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card">
                            <table className="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">check In</th>
                                        <th scope="col">check Out</th>
                                        <th scope="col">Total Working Hours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {
                                        this.state.attendancelist.length > 0 &&
                                        this.state.attendancelist.map((row) =>

                                            <tr key={row.id}>
                                                <td>{row.name}</td>
                                                <td>{row.check_in}</td>
                                                <td>{row.check_out}</td>
                                                <td>{row.total_hours}</td>
                                            </tr>
                                        )
                                    }

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Attendance;