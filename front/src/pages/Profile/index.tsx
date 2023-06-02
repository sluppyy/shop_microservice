import { logout, useAppDispatch, useAppSelector } from '@/store'
import { Link } from 'react-router-dom'

export default function Profile() {
  const [user, status] = useAppSelector((s) => [s.auth.user, s.auth.authStatus])
  const dispatch = useAppDispatch()

  if (status != 'ok' || user === null)
    return (
      <div
        className="h-100 d-flex text-center justify-content-center align-items-center"
        style={{ fontSize: '1.5em' }}
      >
        Необходимо{' '}
        <Link to="/auth" className="ms-2">
          {' '}
          авторизоваться
        </Link>
      </div>
    )

  return (
    <div className="h-100 flex-full d-flex justify-content-center pt-4">
      <div className="col-lg-8">
        <div className="card mb-4">
          <div className="card-body">
            <div className="row">
              <div className="col-sm-3">
                <p className="mb-0">
                  <i className="bi-person" /> Никнейм
                </p>
              </div>
              <div className="col-sm-9">
                <p className="text-muted mb-0">{user.username}</p>
              </div>
            </div>
            <hr />
            <div className="row">
              <div className="col-sm-3">
                <p className="mb-0">
                  <i className="bi-envelope" /> Email
                </p>
              </div>
              <div className="col-sm-9">
                <p className="text-muted mb-0">{user.email}</p>
              </div>
            </div>
            <hr />
            <button
              className="btn btn-danger"
              onClick={() => {
                dispatch(logout())
              }}
            >
              Выйти
            </button>
          </div>
        </div>
      </div>
    </div>
  )
}
