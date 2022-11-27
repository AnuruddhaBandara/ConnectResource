import React from 'react';
import ReactDOM from 'react-dom';
import App  from "./components/App";


if (document.getElementById('table_list')) {
    ReactDOM.render(<App />, document.getElementById('table_list'));
}
