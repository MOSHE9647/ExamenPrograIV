import React from 'react';
import './App.css';
import Index from './components/Index.jsx';
import UserManagement from './components/UserManagement.jsx';
import { BrowserRouter, Route, Routes } from "react-router-dom";

function App() {
	return (
		<div className="App">
			<BrowserRouter>
				
				<Routes>
					<Route path='/' element={<Index />} />
					<Route path='/react' element={<UserManagement />} />
				</Routes>
			
			</BrowserRouter>
		</div>
	);
}

export default App;
