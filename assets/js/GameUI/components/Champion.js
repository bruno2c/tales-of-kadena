import React from 'react'

const Champion = ({ champion }) => (

    (champion.id &&
        <div className={ "champion-slot" + champion.slot }>
            <div className="health-bar">
                <div className="current">&nbsp;</div>
                <div className="border">&nbsp;</div>
                <span className="text">{ champion.health } / { champion.health }</span>
            </div>

            <div className={ champion.sprite }></div>
        </div>
    )
)

export default Champion