import React from 'react'

const Enemy = ({ enemy }) => (

    (enemy.id &&
        <div className={ "enemy-slot" + enemy.slot }>
            <div className="health-bar">
                <div className="current" style={{
                    width: (enemy.healthPercentage < 3) ? '3%'
                        : (enemy.healthPercentage > 99) ? '99%'
                        : enemy.healthPercentage + '%'
                }}>&nbsp;</div>
                <div className="border">&nbsp;</div>
                <span className="text">{ enemy.health } / { enemy.maxHealth }</span>
            </div>

            <div className={ enemy.sprite }></div>
        </div>
    )
)

export default Enemy