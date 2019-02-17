import { connect } from 'react-redux'
import Enemy from '../components/Enemy'

const mapStateToProps = (state, ownProps) => {
    return {
        enemy: ownProps.enemy
    }
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {}
}

const EnemyContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(Enemy)

export default EnemyContainer