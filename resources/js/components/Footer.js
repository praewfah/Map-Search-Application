import React from 'react'
import { Link } from 'react-router-dom'

const Footer = () => (
    <footer className="bd-footer">
        <hr/>
        <div className="justify-content-center">
            <div className="text-center small">
                <a href='/document' target="_blank"> Documents </a> | 
                Designed and built by 
                <a href='/aumaporn/cv' target="_blank"> Aumaporn Tangmanosodsikul </a> | 
                GIT URL : 
                <a href='https://github.com/praewfah/Map-Search-Application.git' target="_blank">
                    https://github.com/praewfah/Map-Search-Application.git
                </a>
            </div>
        </div>
    </footer>
)

export default Footer