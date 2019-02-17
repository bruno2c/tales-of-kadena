import React from 'react'

const Enemy = ({ enemy }) => (

    (enemy.id &&
        <div className={ "enemy-slot" + enemy.slot }>
            <div className="health-bar">
                <div className="current">&nbsp;</div>
                <div className="border">&nbsp;</div>
                <span className="text">{ enemy.health } / { enemy.health }</span>
            </div>

            <div className={ enemy.sprite }></div>
        </div>
    )
)

export default Enemy