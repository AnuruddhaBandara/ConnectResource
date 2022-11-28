import Axios from "axios";
import React, { Component } from "react";
import ReactDOM from 'react-dom';

class FileUpload extends Component {

    constructor(props){
        super(props);

        this.state = {
            upload: [],
            // Initially, no file is selected 
            selectedFile: null
        }
        this.handleInputChange = this.handleInputChange.bind(this);
    }

    submit(e) {
      e.preventDefault();
      console.log("hii 1", this.state.selectedFile);
        const formData = new FormData();
        formData.append('file', this.state.selectedFile);
        Axios.post('/import', formData).then((response)  => {
          console.log('sdsad');
        });
    }
    handleInputChange(event) {
      console.log("event.target", event.target);
      this.setState({
          selectedFile: event.target.files[0],
        })
        console.log('sdsad');
  }

    render() {
        return (
          <div className="container py-5">
            <div className="row">
              <div className="col-lg-12">
                <form onSubmit={this.submitHandler} encType="multipart/form-data" id="imageForm">
                  <div className="card shadow">
                    
                    <div className="card-header">
                      <h4 className="card-title fw-bold">
                       Import Attendance Details
                      </h4>
                    </div>
     
                    <div className="card-body">
                      <div className="form-group py-2">
                        <label htmlFor="images">Impot Excel</label>
                        <input
                          type="file"
                          name="image"
                          multiple
                          onChange={this.handleInputChange}
                          className="form-control"
                        />
                        
                      </div>
                    </div>
     
                    <div className="card-footer">
                      <button type="submit" onClick={(e)=>this.submit(e)} className="btn btn-success">
                        Upload
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
     
          </div>
        );
    } 
}
export default FileUpload;