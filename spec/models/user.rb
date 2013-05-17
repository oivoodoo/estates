require 'spec_helper'

describe User do
  describe '#role?' do
    let(:user) { create(:user) }

    it 'should be possible to check role' do
      user.role = 'admin'
      expect(user.role?('admin')).to be_true
      expect(user.role?('another_role')).to be_false
    end
  end  
end